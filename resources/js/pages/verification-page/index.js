import React, { Component } from 'react'
import { Card, Row, Col, Icon, Avatar } from 'antd';
import store from 'store'
const {Meta} = Card;
export default class VerificationPage extends Component {
    render() {
        const user = store.get('user');
        return (
            <Row>
                <Col lg={23} md={12}>
                    <Card bodyStyle={{  background:'lemon-green' }} bordered={false} style={{ width:'75%', background:'lemon-green', margin: '15% auto' }}>
                        Hello, {user.name} please verify your email address: {user.email} please check your inbox and click on the link sent to you from us.
                    </Card>
                </Col>
            </Row>            
        )
    }
}
{/* <div className="gutter-example">
    <Row gutter={16}>
      <Col className="gutter-row" span={6}>
        <div className="gutter-box">col-6</div>
      </Col>
      <Col className="gutter-row" span={6}>
        <div className="gutter-box">col-6</div>
      </Col>
      <Col className="gutter-row" span={6}>
        <div className="gutter-box">col-6</div>
      </Col>
      <Col className="gutter-row" span={6}>
        <div className="gutter-box">col-6</div>
      </Col>
    </Row>
  </div> */}