import React, {Component} from 'react';
import {getNewForm} from '../api/getForm';

class App extends Component {

    constructor(props) {
        super(props);
        this.state = {
            text: '',
        };
        this.textChange = this.textChange.bind(this);
    }

    componentDidMount() {
        document.getElementById('editClick').addEventListener('click', this.textChange);
    }

    formadmin() {

        getNewForm()
            .then(res => {
                if (res.status === 200) {
                    let resArray = res.data;
                    console.dir(res.data);
                    if (resArray) {
                        this.setState({countriesArr: res.data});
                    }
                } else {
                    throw new Error('Countries not last won!');
                }
            })
            .catch(e => console.warn(e));

    };

    textChange() {
        this.setState({text: '!!!111!!!'});
        this.formadmin();
    }

    render() {
        return (
            <div className="modal-col-12 form-group">
                { this.state.text }
            </div>
        )
    }

}

export default App;