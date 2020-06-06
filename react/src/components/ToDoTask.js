import React from 'react';

class ToDoTask extends React.Component {
    /**
     * @property {{ completed: boolean, task: object, onChange: function }} props
     */

    render() {
        const task = this.props.task;

        return (
            <li key={task.id} className="task">
                <label>
                    <input type="checkbox" checked={task.completed} onChange={this.notifyOnChanged.bind(this)}/>
                    <span className="task-description" style={{textDecoration: task.completed && 'line-through'}}>
                        {task.description}
                    </span>
                </label>
            </li>
        );
    }

    notifyOnChanged(e) {
        this.props.onChange(this.props.task.id, e.target.checked);
    }
}

export default ToDoTask;
