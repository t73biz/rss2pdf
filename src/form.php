<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>RSS 2 PDF Converter</title>
    </head>
    <body>
        <h1>RSS 2 PDF Converter</h1>
        <p>This will parse an rss url from the form input, and select the first 5 articles to be output into a pdf.</p>
        <p>
            <form name="parse" action="/" method="post">
                <input size="255" style="width: 75%;height: 25px;display: block;float: left;" name="url" placeholder="Please enter a valid RSS URL." />
                <button style="width: 10%; margin-left: 3%;height: 30px; display: block;" type="submit">Convert</button>
            </form>
        </p>
    </body>
</html>
