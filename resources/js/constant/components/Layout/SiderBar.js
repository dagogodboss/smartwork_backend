import React, { PureComponent } from 'react'
import { Icon, Layout, Menu } from 'antd'
import { config } from '../../../constant/utils/config';
import './SideBar.css';

class SideBar extends PureComponent {
  render() {
    const {
      theme,
      isMobile,
      collapsed,
    } = this.props

    return (
      <Layout.Sider
        width={256}
        theme={theme}
        breakpoint="lg"
        trigger={null}
        collapsible
        collapsed={collapsed}
        // onBreakpoint={isMobile ? null : onCollapseChange}
        className="sider"
      >
        <div className="brand">
          <div className="logo">
            <img alt="logo" src={config.logoPath} />
            {collapsed ? null : <h1>{config.siteName}</h1>}
          </div>
        </div>
        <Menu theme="light" mode="inline" defaultSelectedKeys={['1']}>
          <Menu.Item key="1" style={{paddingLeft:"19px !important" }} className="collapsedIcon">
            <Icon type="home" />
            <span>HOME</span>
          </Menu.Item>
          <Menu.Item key="2" style={{paddingLeft:"19px !important" }}  className="collapsedIcon">
            <Icon type="bank" />
            <span>SAVE</span>
          </Menu.Item>
          <Menu.Item key="3" style={{paddingLeft:"19px !important" }}  className="collapsedIcon">
            <Icon type="money-collect" />

            <span>WITHDRAW</span>
          </Menu.Item>
        </Menu>
      </Layout.Sider>
    )
  }
}

export default SideBar
