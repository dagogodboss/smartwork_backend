import React, { PureComponent, Fragment } from 'react'
import { Menu, Icon, Layout, Avatar, Popover, Badge, List } from 'antd'
import classnames from 'classnames'
import './Header.css'
const { SubMenu } = Menu
class Header extends PureComponent {
    handleClickMenu (e) {
      e.key === 'SignOut' && this.props.onSignOut()
    }
    render() {
      const {
        fixed,
        avatar,
        username,
        collapsed,
        notifications
      } = this.props
      const rightContent = [
        <Menu key="user" mode="horizontal" onClick={this.handleClickMenu}>
          <SubMenu
            title={
              <Fragment>
                <span style={{ color: '#999', marginRight: 4 }}>
                  <big>Hi,</big>
                </span>
                <span>{username}</span>
                <Avatar style={{ marginLeft: 8 }} src={avatar} />
              </Fragment>
            }
          >
            <Menu.Item key="SignOut">
              <span>Sign out</span>
            </Menu.Item>
          </SubMenu>
        </Menu>,
      ]
  
      rightContent.unshift(
        <Popover
          placement="bottomRight"
          trigger="click"
          key="notifications"
          overlayClassName='notificationPopover'
          getPopupContainer={() => document.querySelector('#layoutHeader')}
          content={
            <div className='notification'>
              <List
                itemLayout="horizontal"
                dataSource={notifications}
                locale={{
                  emptyText: <span>You have viewed all notifications.</span>,
                }}
                renderItem={item => (
                  <List.Item className='notificationItem'>
                    <List.Item.Meta
                      title={
                        <Ellipsis tooltip lines={1}>
                          {item.title}
                        </Ellipsis>
                      }
                      description={moment(item.date).fromNow()}
                    />
                    <Icon
                      style={{ fontSize: 10, color: '#ccc' }}
                      type="right"
                      theme="outlined"
                    />
                  </List.Item>
                )}
              />
              {notifications.length ? (
                <div
                  onClick={onAllNotificationsRead}
                  className='clearButton'
                >
                  <span>Clear notifications</span>
                </div>
              ) : null}
            </div>
          }
        >
          <Badge
            count={notifications.length}
            dot
            offset={[-10, 10]}
            className='iconButton'
          >
            <Icon className='iconFont' type="bell" />
          </Badge>
        </Popover>
      )
      return (
        <Layout.Header
          className={classnames('header', {
            [fixed]: 'fixed',
            [collapsed]: 'collapsed',
          })}
          id="layoutHeader"
        >
          <div className='rightContainer'>{rightContent}</div>

        </Layout.Header>
      )
    }
  }
export default Header