import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import App from './modalAdmin/App';


class Home extends Component {

    render() {
        return (
                <App/>
        )
    }
}

ReactDOM.render(<Home />, document.getElementById('modalForAdmin'));