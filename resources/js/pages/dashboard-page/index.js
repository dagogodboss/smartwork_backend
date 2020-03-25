import React from 'react'
import { connect } from 'react-redux';
import CountUp from 'react-countup'
import { Col, Card } from 'antd';
import usersAction from './../../site-actions/actions/users';
import PageLayout from './../../constant/components/Page/Layout/index';
import BvnForm from './components/bvn-form';

class DashboardPage extends React.Component {
  constructor(props) {
      super(props);
      this.state = {
        collapsed: true,
        isMobile:true,
      };  
  }
  
  componentWillMount(){
  }
  
  componentDidCatch(){
    console.log('Erroorr')
  }

  render() {
    return (
      <PageLayout >
      <BvnForm  />
        <Col lg={6}>
          <Card style={{}}> 
            <CountUp
              start={0}
              end={100}
              duration={5}
              useEasing
              useGrouping
              separator=","
            />
          </Card>
        </Col>
      </PageLayout>
        
        
    )
  }
}

const mapStateToProps = (state)=>{
  return {
    User : state.UsersReducer
  }
}

export default connect(mapStateToProps,{ usersAction})(DashboardPage)
