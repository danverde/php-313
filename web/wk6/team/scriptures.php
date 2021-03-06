<!doctype html>
<?php 
session_start();

    $dbUrl = getenv('DATABASE_URL');
    $dbopts = parse_url($dbUrl);
    $dbHost = $dbopts["host"];
    $dbPort = $dbopts["port"];
    $dbUser = $dbopts["user"];
    $dbPassword = $dbopts["pass"];
    $dbName = ltrim($dbopts["path"],'/');
    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    $book = filter_input(INPUT_POST, 'book', FILTER_SANITIZE_STRING);
    $chapter = filter_input(INPUT_POST, 'chapter', FILTER_SANITIZE_STRING);
    $verse = filter_input(INPUT_POST, 'verse', FILTER_SANITIZE_STRING);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
    $topics = filter_input(INPUT_POST, 'topics', FILTER_SANITIZE_STRING);
    // $topics = $_POST['topics'];//filter_input(INPUT_POST, 'topics', FILTER_SANITIZE_STRING);
    
    try {
        $stmt = $db->prepare('INSERT INTO scriptures(book, chapter, verse, content) VALUES(:book, :chapter, :verse, :content)');
        $stmt->bindValue(':book', $book, PDO::PARAM_STR);
        $stmt->bindValue(':chapter', $chapter, PDO::PARAM_STR);
        $stmt->bindValue(':verse', $verse, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->execute();

        $scriptureId = $db->lastInsertId('scriptures_id_seq');

        foreach ($topics as $topic) {
            $stmt = $db->prepare('INSERT INTO scripture_topic(scripture_id, topic_id) VALUES(:scrId, :topId)');
            $stmt->bindValue(':scrId', $scriptureId, PDO::PARAM_STR);
            $stmt->bindValue(':topId', $topic, PDO::PARAM_STR);
            $stmt->execute();
        }
    

    } catch (Exception $err) {
        echo "I died";
        echo $err;
        die();
    }


    try {
        $stmt = $db->prepare('SELECT name, book, chapter, verse, content FROM scriptures AS sc JOIN scripture_topic AS st ON sc.scripture_id=st.scripture_id');
        $stmt->execute();
        $scriptures = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $err) {
        echo "I died later";
        echo $err;
        die();
    }

?>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Scripture Display</title>

</head>

    <body>
    </body>
</html>

