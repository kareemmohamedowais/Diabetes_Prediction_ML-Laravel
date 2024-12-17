
from flask import Flask, request, jsonify 
from flask_cors import CORS
import joblib  
import pandas as pd
import numpy as np
app = Flask(__name__)
CORS(app)  

logistic_regression_model = joblib.load('logistic_regression_model.pkl')
svm = joblib.load('svm_model.pkl')
decision_tree = joblib.load('decision_tree_model.pkl')
scaler = joblib.load('scaler.pkl')  

required_columns = ['Pregnancies', 'Glucose', 'BloodPressure', 'SkinThickness', 'Insulin', 'BMI', 'Age']



@app.route('/predict', methods=['POST'])
def predict():
    try:
        input_data = request.json

        for column in required_columns:
            if column not in input_data:
                return jsonify({'error': f"Missing required field: {column}"}), 400

        data = pd.DataFrame([input_data])
        

        data[required_columns] = scaler.transform(data[required_columns])
        Model_used = ''
        selected_model = data['Model_selectd'].iloc[0]
        if selected_model == 'logistic_regression_model':
            Model_used = 'logistic_regression_model'
            data = data.drop(columns=["Model_selectd"])
            prediction = logistic_regression_model.predict(data)[0]
        elif selected_model == 'decision_tree_model':
            Model_used = 'decision_tree'
            data = data.drop(columns=["Model_selectd"])
            prediction = decision_tree.predict(data)[0]
        elif selected_model == 'svm_model':
            Model_used = 'svm'
            data = data.drop(columns=["Model_selectd"])
            prediction = svm.predict(data)[0]
        else:
            return 'error'
        

        return jsonify({'prediction': int(prediction),'Model_used':Model_used })
    except Exception as e:
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
