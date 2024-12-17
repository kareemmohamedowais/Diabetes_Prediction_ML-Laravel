<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diabetes Prediction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h2 class="mb-4">Diabetes Prediction Result</h2>
                <div class="alert
                    @if ($prediction == 1)
                        alert-danger
                    @else
                        alert-success
                    @endif">
                    @if ($prediction == 1)
                        <strong>Diabetic</strong> (مريض بالسكري)
                    @else
                        <strong>Non-Diabetic</strong> (غير مريض بالسكري)
                    @endif
                </div>
                <h3>
                    Model_Used ==> {{$Model_used}}
                </h3>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
