import sys
import json

def recommend_plans(user_goal, focus_area, plans):
    # Simple rule-based filtering
    recommendations = [p for p in plans if p['goal'] == user_goal and p['area'] == focus_area]
    return recommendations

if __name__ == "__main__":
    # Get arguments from Laravel
    user_goal = sys.argv[1]
    focus_area = sys.argv[2]
    plans_json = sys.argv[3]

    plans = json.loads(plans_json)
    result = recommend_plans(user_goal, focus_area, plans)

    # Return JSON string to Laravel
    print(json.dumps(result))
