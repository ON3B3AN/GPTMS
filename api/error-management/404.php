<!DOCTYPE html>
<html>
    <head>
        <?php
            header('HTTP/1.0 404 Not Found', true, 404);
            http_response_code(404);
        ?>
    </head>
    <body>
        <p>
            Oops, I screwed up and you discovered my fatal flaw.<br>
            Well, we're not all perfect, but we try.<br>
            Can you try this again or maybe visit our <a title="Our Site" href="http://localhost/GPTMS/api/index.php">Home Page</a> to start fresh.<br>
            We'll do better next time.
        </p>
    </body>
</html>
