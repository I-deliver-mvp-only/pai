import React from 'react';
import TaskCompletedFilter from './TaskCompletedFilter';
import ToDoList from './ToDoList';
import AddTask from './AddTask';

class App extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            hideCompletedTasks: false,
            tasks: [],
        };
    }

    render() {
        return (
            <div>
                <TaskCompletedFilter onChange={this.updateHideCompletedTasks.bind(this)}/>
                <ToDoList
                    hideCompleted={this.state.hideCompletedTasks}
                    tasks={this.state.tasks}
                    onTaskCompletedChanged={this.updateTaskCompleted.bind(this)}/>
                <AddTask onAddTask={this.addNewTask.bind(this)}/>
            </div>
        );
    }

    /**
     * @param {boolean} hide
     */
    updateHideCompletedTasks(hide) {
        this.setState((prevState) => ({
            hideCompletedTasks: hide,
            tasks: prevState.tasks,
        }));
    }

    /**
     * @param {number} taskId
     * @param {boolean} completed
     */
    updateTaskCompleted(taskId, completed) {
        this.setState((prevState) => ({
            hideCompletedTasks: prevState.hideCompletedTasks,
            tasks: prevState.tasks.map((task, i) => (i === taskId) ? {...task, completed} : task),
        }));
    }

    /**
     * @param {string} taskDescription
     */
    addNewTask(taskDescription) {
        const newTask = {
            id: this.state.tasks.length,
            description: taskDescription,
            completed: false,
        };

        this.setState((prevState) => ({
            hideCompletedTasks: prevState.hideCompletedTasks,
            tasks: [ ...prevState.tasks, newTask ],
        }));
    }
}

export default App;
