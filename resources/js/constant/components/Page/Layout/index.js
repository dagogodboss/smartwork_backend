import React from "react";
import { connect } from "react-redux";
import { Layout } from "antd";
import { Redirect } from "react-router-dom";
import { isMobile } from "react-device-detect";

import Header from "./../../Layout/Header";
import SideBar from "./../../Layout/SiderBar";
import { config } from "./../../../utils/config";
import usersAction from './../../../../site-actions/actions/users';

class PageLayout extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            logout : false,
            isMobile: false,
            notifications: []
        };
    }
    componentWillMount() {
        this.props.usersAction({ target: "auth" });
        if (isMobile) {
            this.setState({ isMobile: true });
        }
    }
    
    componentDidMount(){
        this.props.usersAction({target: "getUser"}).then(
            (res)=>{
                if(this.props.AuthUser.unverifiedEmail === true ){
                    this.setState({logout :true})
                }
            }
        );
    }

    render() {
        const { logout, isAuth, unverifiedEmail } = this.props.AuthUser;
        console.log(this.props.AuthUser)
        if (isAuth == false && logout == true) {
            return <Redirect to="/login" replace />;
        }
        if (unverifiedEmail == true && isAuth == true) {
            console.log(this.props)
            return <Redirect to="/verification" replace />;
        }
        return (
            <Layout style={{ width: "100%", height: "100%" }}>
                <SideBar
                    theme="light"
                    collapsed={true}
                    isMobile={this.state.isMobile}
                />
                <Header
                    notifications={this.state.notifications}
                    collapsed="collapsed"
                    fixed="fixed"
                    avatar={config.defaultAvatar}
                    username='this.props.username'
                />
                <Layout.Content
                    style={{
                        margin: "80px 16px",
                        padding: 24,
                        minHeight: "inherit",
                        minWidth: "inherit"
                    }}
                >
                    {this.props.children}
                </Layout.Content>
            </Layout>
        );
    }
}

const mapStateToProps = state => {
    return {
        AuthUser: state.UsersReducer
    };
};

export default connect(
    mapStateToProps,
    { usersAction }
)(PageLayout);
