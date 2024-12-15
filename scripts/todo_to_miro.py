import json
from datetime import datetime

def parse_todo_md(md_file):
    boards = []
    current_x = 0
    current_y = 0
    VERTICAL_SPACING = 300
    HORIZONTAL_SPACING = 400
    
    with open(md_file, 'r') as file:
        content = file.readlines()
    
    current_epic = None
    current_feature = None
    
    for line in content:
        line = line.strip()
        
        if not line:
            continue
            
        # Epic (Main sections)
        if line.startswith('## '):
            current_x = 0
            current_y += VERTICAL_SPACING
            epic_name = line.replace('## ', '').strip()
            
            # Create epic card
            boards.append({
                'type': 'card',
                'style': {
                    'backgroundColor': '#FF7F50',  # Coral color for epics
                    'textColor': '#FFFFFF'
                },
                'text': epic_name,
                'x': current_x,
                'y': current_y,
                'width': 300,
                'height': 100
            })
            current_epic = epic_name
            continue
            
        # Feature
        if line.startswith('FEATURE:'):
            current_x += HORIZONTAL_SPACING
            feature_name = line.replace('FEATURE:', '').strip()
            
            # Create feature card
            boards.append({
                'type': 'card',
                'style': {
                    'backgroundColor': '#4169E1',  # Royal Blue for features
                    'textColor': '#FFFFFF'
                },
                'text': feature_name,
                'x': current_x,
                'y': current_y,
                'width': 250,
                'height': 80
            })
            current_feature = feature_name
            continue
            
        # Tasks
        if line.startswith('  - TASK'):
            current_x += HORIZONTAL_SPACING
            task_name = line.replace('  - TASK', '').replace('[NUEVO]:', '').replace('[URGENTE]:', '').strip()
            
            # Create task card
            card_color = '#FF4500' if '[URGENTE]' in line else '#32CD32'  # OrangeRed for urgent, LimeGreen for normal
            boards.append({
                'type': 'card',
                'style': {
                    'backgroundColor': card_color,
                    'textColor': '#FFFFFF'
                },
                'text': task_name,
                'x': current_x,
                'y': current_y,
                'width': 200,
                'height': 60
            })
            
            # Create connection to feature
            boards.append({
                'type': 'connector',
                'style': {
                    'lineColor': '#808080',
                    'lineStyle': 'straight'
                },
                'start': {'x': current_x - HORIZONTAL_SPACING, 'y': current_y + 30},
                'end': {'x': current_x, 'y': current_y + 30}
            })
            
    return boards

def create_miro_json(boards, output_file):
    with open(output_file, 'w') as f:
        json.dump({
            'version': '1.0',
            'type': 'miro.board',
            'content': boards
        }, f, indent=2)

def main():
    input_file = '../TODO.md'
    output_file = f'miro_board_{datetime.now().strftime("%Y%m%d")}.json'
    
    boards = parse_todo_md(input_file)
    create_miro_json(boards, output_file)
    print(f'Created Miro board file: {output_file}')

if __name__ == '__main__':
    main()
