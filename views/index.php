<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
<!--    <link rel="stylesheet" href="../assets/styles/indexStyle.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z5vIOxSTP1NLy+giFjs/nyQr5c4M5k8Z6jY6h3" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 sidebar">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('speed')">Show Speed Items</a></li>
                <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('production')">Calculate Production Tonnage</a></li>
                <li class="nav-item"><a class="nav-link" href="#" onclick="showContent('performance')">Personnel Performance</a></li>
            </ul>
        </div>
        <div class="col-lg-9 content" id="content">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>
<script>

    function showContent(feature) {
        // Get the content div
        var contentDiv = document.getElementById('content');

        // Use fetch or XMLHttpRequest to load content from the server
        fetch(feature + '.php')
            .then(response => response.text())
            .then(data => {
                // Load the response into the content div
                contentDiv.innerHTML = data;
            })
            .catch(error => console.error('Error loading content:', error));
    }


</script>

</body>
</html>

