import React, { Component } from 'react'
import { ToastContainer } from 'react-toastr';

export default class Toast extends Component {
    showToast(){
	    this.refs.container.info(
	      this.props.text,
	      this.props.title, {
	      timeOut: 30000,
	      extendedTimeOut: 10000
	    });
    }
    render() {
        return (
            <ToastContainer 
                ref="container" 
                className="toast-top-right" 
                show={( this.props.showToast ) ? this.showToast() : ''}
            />
        )
    }
}
