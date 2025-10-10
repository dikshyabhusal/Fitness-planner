import json
import sys

if len(sys.argv) < 2:
    print("Error: No input JSON provided")
    sys.exit(1)

try:
    student_data = json.loads(sys.argv[1])
except json.JSONDecodeError as e:
    print("Error reading JSON:", e)
    sys.exit(1)

# --- BMI calculation and recommendation logic ---
weight = student_data.get("weight")
height = student_data.get("height")
bmi = student_data.get("bmi")

if bmi is None and weight and height:
    bmi = round(weight / ((height/100) ** 2), 1)
    student_data["bmi"] = bmi

# Determine BMI category
if bmi < 18.5:
    bmi_category = "Underweight"
elif 18.5 <= bmi < 25:
    bmi_category = "Normal weight"
elif 25 <= bmi < 30:
    bmi_category = "Overweight"
else:
    bmi_category = "Obese"

goal = student_data.get("goal", "").lower()
recommendations = []

if goal == "lose weight":
    if bmi >= 25:
        recommendations = ["HIIT", "Cardio 30-45 mins", "Strength training 3x/week"]
    else:
        recommendations = ["Moderate Cardio", "Core exercises", "Light strength training"]
elif goal == "gain weight":
    recommendations = ["Strength training 4-5x/week", "Protein-rich diet", "Compound lifts"]
elif goal == "maintain weight":
    recommendations = ["Balanced Cardio & Strength", "3-4 workouts per week"]
else:
    recommendations = ["General fitness: Cardio + Strength mix"]

# Output the recommendations as JSON for Laravel
print(json.dumps({
    "student": student_data,
    "bmi_category": bmi_category,
    "recommendations": recommendations
}))
