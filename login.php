<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Phonebook - login</title>
</head>
<body>
    
    <div class="container">

        <div class="row mt-5">
            <div class="col-6 offset-3">
                <h3 class="text-center">Prijava</h3>
                <form action="tryLogin.php" method="POST">
                    <input type="text" required class="mt-3 form-control" name="username" placeholder="Korisnicko ime...">
                    <input type="password" required class="mt-3 form-control" name="password" placeholder="Lozinka...">

                    <button class="btn float-end mt-3 btn-primary">Prijavi me</button>
                </form>
            </div>
        </div>

    </div>

    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
