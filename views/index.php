<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/styles/indexStyle.css">
    <link rel="stylesheet" href="../assets/styles/indexStyle.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
    <script src="../assets/bootstrap/js/bootstrap.js"></script>
    <title>Document</title>
</head>
<body>

<div class="container-fluid vh-100">
    <div class="row h-100">
        <div class="col-lg-2 d-flex flex-column p-0 bg-dark text-light sidebar" >
            <ul class="nav flex-column flex-lg-1" >
                <li class="nav-item"><a class="nav-link custom-link" href="#" onclick="showContent('speedView')">نمایش سرعت</a>
                </li>
                <li class="nav-item"><a class="nav-link custom-link" href="#" onclick="showContent('login')">تناژ تولید</a></li>
                <li class="nav-item"><a class="nav-link custom-link" href="#" onclick="showContent('performance')">عملکرد شیفت ها
                        </a></li>
            </ul>
        </div>
        <div class="col-lg-9 content" id="content">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>
<script>

    function showContent(feature) {
        var contentDiv = document.getElementById('content');
        fetch(feature + '.php')
            .then(response => response.text())
            .then(data => {
                contentDiv.innerHTML = data;
            })
            .catch(error => console.error('Error loading content:', error));
    }
</script>

</body>
</html>

