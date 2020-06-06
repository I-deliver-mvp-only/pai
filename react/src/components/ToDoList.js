import React from 'react';
import ToDoTask from './ToDoTask';

class ToDoList extends React.Component {
    /**
     * @property {{ hideCompleted: boolean, tasks: array, onTaskCompletedChanged: function }} props
     */

    render() {
        const filteredTasks = this.props.tasks.filter(task => !this.props.hideCompleted || !task.completed);

        if (!filteredTasks.length) {
            return <h3>To Do list is empty</h3>
        }

        return (
            <ul className="tasks-list">
                {
                    filteredTasks.map((task) => {
                        return (

                            <ToDoTask key={task.id} task={task} onChange={this.props.onTaskCompletedChanged}/>

                        );
                    })
                }
            </ul>
        )
    }
}

export default ToDoList;
