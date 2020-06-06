import React from 'react';

class ToDoTask extends React.Component {
    /**
     * @property {{ onAddTask: function }} props
     */

    render() {
        return (
            <div>
                <input type="text" onBlur={this.notifyOnClicked.bind(this)}/>
                <button onClick={this.notifyOnClicked.bind(this)}>Add task</button>
            </div>
        );
    }

    notifyOnClicked(e) {
        const input = e.target.parentNode.querySelector('input');
        if (input.value === '') {
            return;
        }

        this.props.onAddTask(input.value);
        input.value = '';
    }
}

export default ToDoTask;
