import React, {Component} from 'react';
import {getNewForm, getFormVal} from '../api/getForm';
import Liform from 'liform-react';


class App extends Component {

    constructor(props) {
        super(props);
        this.state = {
            text: '',
            arrJson: false,
            valJson: false,
            checkmark: '',
            idBlock: ''
        };
        this.textChange = this.textChange.bind(this);
        this.clickirstQ = this.clickirstQ.bind(this);
    }

    // componentDidUpdate(nextProps, nextState) {
    //     if (this.state.valJson !== nextState.valJson){
    //         // console.log(666, document.getElementsByName('titleRu')[0].value = this.state.valJson.titleRu)
    //         document.getElementsByName('titleRu').forEach((val)=>(val.setAttribute('placeholder', false), val.innerHTML = this.state.valJson.titleRu) )
    //     }
    // }

    // componentWillMount() {
    //     this.formadmin();
    // }

    componentDidMount() {
        document.getElementById('editClick').addEventListener('click', this.textChange);
        document.getElementById('editClickFirstQ').addEventListener('click', this.clickirstQ);
    }

    formadmin() {

        // getNewForm()
        //     .then(res => {
        //         if (res.status === 200) {
        //             let resArray = res.data;
        //             // console.log('arrJson', res.data)
        //             if (resArray) {
        //                 this.setState({arrJson: JSON.parse(res.data)});
        //             }
        //         } else {
        //             throw new Error('Countries not last won!');
        //         }
        //     })
        //     .catch(e => console.warn(e));

        getFormVal({checkmark: this.state.checkmark, idBlock: this.state.idBlock})
            .then(res => {
                if (res.status === 200) {
                    let resArray = res.data;
                    console.log('valJson', res.data)
                    if (resArray) {
                        this.setState({valJson: JSON.parse(res.data)});
                    }
                } else {
                    throw new Error('Countries not last won!');
                }
            })
            .catch(e => console.warn(e));

    };

    textChange() {
        this.setState({checkmark: 'first', idBlock: 1});
        this.formadmin();
    }

    clickirstQ() {
        // console.log(111)
        this.setState({checkmark: 'first', idBlock: 2});
        this.formadmin();
    }

    // inputChangedHandler = (event) => {
    //     this.setState({valJson:{text: event.target.value}});
    //     // May be call for search result
    // }

    render() {
        console.log(this.state.valJson.text);
        return (
            <div className="modal-col-12 form-group">
                <label>Text</label>
                {this.state.valJson ?
                    <textarea type="text" id="home_block_text_text" name="home_block_text[text]" className="form-control" >{this.state.valJson.text}</textarea>
                    : ''}

                {/*{ this.state.text }*/}
            </div>
        )
    }

}

export default App;