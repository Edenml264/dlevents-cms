import csv
import re
from datetime import datetime

def parse_todo_md(md_file):
    tasks = []
    current_epic = ""
    current_feature = ""
    
    with open(md_file, 'r') as file:
        content = file.readlines()
        
    for line in content:
        line = line.strip()
        
        # Skip empty lines
        if not line:
            continue
            
        # Epic (Main sections)
        if line.startswith('## '):
            current_epic = line.replace('## ', '').strip()
            continue
            
        # Feature
        if line.startswith('FEATURE:'):
            current_feature = line.replace('FEATURE:', '').strip()
            continue
            
        # Tasks
        if line.startswith('  - TASK'):
            task_name = line.replace('  - TASK', '').replace('[NUEVO]:', '').replace('[URGENTE]:', '').strip()
            priority = 'High' if '[URGENTE]' in line else 'Medium'
            
            task = {
                'Summary': task_name,
                'Issue Type': 'Task',
                'Priority': priority,
                'Epic Link': current_epic,
                'Feature': current_feature,
                'Description': '',
                'Labels': []
            }
            
            if '[NUEVO]' in line:
                task['Labels'].append('nuevo')
            if '[URGENTE]' in line:
                task['Labels'].append('urgente')
                
            tasks.append(task)
            continue
            
        # Subtasks (items with *)
        if line.strip().startswith('*'):
            if tasks:  # If we have a parent task
                subtask = line.strip('* ').strip()
                last_task = tasks[-1]
                if not last_task['Description']:
                    last_task['Description'] = '* ' + subtask
                else:
                    last_task['Description'] += '\n* ' + subtask
                    
    return tasks

def create_jira_csv(tasks, output_file):
    fieldnames = ['Summary', 'Issue Type', 'Priority', 'Epic Link', 'Feature', 'Description', 'Labels']
    
    with open(output_file, 'w', newline='') as csvfile:
        writer = csv.DictWriter(csvfile, fieldnames=fieldnames)
        writer.writeheader()
        for task in tasks:
            task['Labels'] = ','.join(task['Labels']) if task['Labels'] else ''
            writer.writerow(task)

def main():
    input_file = '../TODO.md'
    output_file = f'jira_import_{datetime.now().strftime("%Y%m%d")}.csv'
    
    tasks = parse_todo_md(input_file)
    create_jira_csv(tasks, output_file)
    print(f'Created JIRA import file: {output_file}')

if __name__ == '__main__':
    main()
