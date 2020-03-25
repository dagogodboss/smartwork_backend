import React, { Component } from 'react'
import { Form, Icon, Input, Button, Checkbox } from 'antd';

export default class BvnForm extends Component {
    
    handleSubmit (e) {
        e.preventDefault();
        this.props.form.validateFields((err, values) => {
          if (!err) {
            console.log('Received values of form: ', values);
          }
        });
    }

    render() {
        // const { getFieldDecorator } = Form;
        // const {user} = this.props;
        // if(user.bvn_check){
        //    return;  
        // }
        return (
            <Form onSubmit={this.handleSubmit} className="login-form">
                <Form.Item>
                {/* {getFieldDecorator('Bank Verification Number BVN', {
                    rules: [{ required: true, message: 'Please input your Bank Verification Number BVN!' }],
                })(
                    <Input
                    prefix={<Icon type="user" style={{ color: 'rgba(0,0,0,.25)' }} />}
                    placeholder="BVN Number"
                    />,
                )} */}
                <Input
                    prefix={<Icon type="user" style={{ color: 'rgba(0,0,0,.25)' }} />}
                    placeholder="BVN Number"
                />
                </Form.Item>
                <Form.Item>
                <Button type="primary" htmlType="submit" className="login-form-button">
                   Verify Account 
                </Button>
                </Form.Item>
            </Form>
        )
    }
}