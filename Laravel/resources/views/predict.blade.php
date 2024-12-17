<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diabetes Prediction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <!-- Display Result Message -->
        @if (session('result'))
            <div class="alert alert-success text-center">
                {{ session('result') }}
            </div>
        @endif

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('diabetes.predict') }}" class="p-4 border rounded shadow-sm bg-light">
            @csrf
            <h3 class="text-center mb-4">Diabetes Prediction</h3>

            <div class="mb-3">
                <label for="Pregnancies" class="form-label">Number of Pregnancies:</label>
                <input type="text" class="form-control" id="Pregnancies" name="Pregnancies" required>
            </div>

            <div class="mb-3">
                <label for="Glucose" class="form-label">Glucose Level:</label>
                <input type="text" class="form-control" id="Glucose" name="Glucose" required>
            </div>

            <div class="mb-3">
                <label for="BloodPressure" class="form-label">Blood Pressure:</label>
                <input type="text" class="form-control" id="BloodPressure" name="BloodPressure" required>
            </div>

            <div class="mb-3">
                <label for="SkinThickness" class="form-label">Skin Thickness:</label>
                <input type="text" class="form-control" id="SkinThickness" name="SkinThickness" required>
            </div>

            <div class="mb-3">
                <label for="Insulin" class="form-label">Insulin Level:</label>
                <input type="text" class="form-control" id="Insulin" name="Insulin" required>
            </div>

            <div class="mb-3">
                <label for="BMI" class="form-label">Body Mass Index (BMI):</label>
                <input type="text" step="0.01" class="form-control" id="BMI" name="BMI" required>
            </div>

            <div class="mb-3">
                <label for="DiabetesPedigreeFunction" class="form-label">Diabetes Pedigree Function:</label>
                <input type="text" step="0.01" class="form-control" id="DiabetesPedigreeFunction"
                    name="DiabetesPedigreeFunction" required>
            </div>

            <div class="mb-3">
                <label for="Age" class="form-label">Age:</label>
                <input type="text" class="form-control" id="Age" name="Age" required>
            </div>
            <div class="mb-3">
                <label for="select_Model" class="form-label">select_Model:</label>
                <select class="select_Model" name="Model_selectd" aria-label="Default select example">
                    <option selected>select_Model</option>
                    <option value="logistic_regression_model">logistic_regression_model</option>
                    <option value="decision_tree_model">decision_tree_model</option>
                    <option value="svm_model">svm_model</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Predict</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
