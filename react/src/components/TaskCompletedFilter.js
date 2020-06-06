import React from 'react';

class TaskCompletedFilter extends React.Component {
    /**
     * @property {{ onChanged: function }} props
     */

    render() {
        return (
            <div className="tasksFilter">
                <label>
                    Hide completed tasks
                    <input type="checkbox" onChange={this.notifyOnChange.bind(this)}/>
                </label>
            </div>
        );
    }

    notifyOnChange(e) {
        this.props.onChange(e.target.checked)
    }
}

export default TaskCompletedFilter;
