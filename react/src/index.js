import React from 'react';
import ReactDOM from 'react-dom';
import App from './components/App';

function $(selector) {
    return document.querySelector(selector);
}

ReactDOM.render(<App/>, $('#root'));
