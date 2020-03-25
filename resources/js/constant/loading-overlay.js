import React, { Component } from 'react'

export default class LoadingOverlay extends Component {
    styles(){
        return {
            background: 'rgba(255, 222, 255, 0.63)',
            height: '100%',
            width: '100%',
            left: 0,
            right: 0,
            top: 0,
            bottom: 0,
            position: 'fixed',
            zIndex: 1111,
        }
    } 
    render() {
        return (
            <div style={this.styles()}>
                
            </div>
        )
    }
}
