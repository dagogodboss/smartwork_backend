import React from 'react'
import ReeValidate from 'ree-validate'
import { connect } from 'react-redux';
import store from 'store';
import { Link, Redirect } from 'react-router-dom';
import { register, login, logout } from './../../site-actions/actions/authentication';
import Toast from './../../constant/toast';
import LoadingOverlay from './../../constant/loading-overlay';
if(window.location.pathname === '/login'){
  require('./Login.css');
}
class LoginPage extends React.Component {
  constructor(props){
    super(props);
    this.validator = new ReeValidate({
      name:'required|min:3',
      email: 'required|email',
      password: 'required|min:6',
      password_confirmation : 'required|min:6',
    });
    this.state = {
      formData :{
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
      redirect:'',
      isLoading:false,
      showToast:false,   
      MessageTitle:'',   
      MessageBody:'',
      serverErrors : {},
      errors:this.validator.errors,
    }
    this.login = this.login.bind(this);    
    this.register = this.register.bind(this);    
    this.onChange = this.onChange.bind(this);    
    this.toggleForm = this.toggleForm.bind(this);    
  }
  
  getError(){
    const {errorMessage} = this.props.Authentication
    if(errorMessage.response.status !== 422){
      console.log(this.props.Authentication)
      return this.setState({
        serverErrors:errorMessage, 
        MessageBody:this.props.Authentication.errorMessage.response.data.message,
        MessageTitle:'Authentication Error',
        isLoading:false,
        showToast:true, 
      })
    }
    const {errors} = errorMessage.response.data;
    this.setState({serverErrors : errors, isLoading:false});
  }
  
  isSuccessFul(data, destination){
    this.setState({serverErrors : {}, isLoading:true});
    switch (destination) {
      case 'verification':        
        this.localStorage(data)
        this.setState({showToast:true, MessageBody: 'Registration Completed, redirecting you shortly', MessageTitle:'Process Completed'});
        return this.redirect('verification')
      default:
        this.localStorage(data)
        this.setState({showToast:true, MessageBody: 'Authentication Completed, redirecting you shortly', MessageTitle:'Process Completed'});
        return this.redirect();
    }
  }
  
  localStorage(data){
    if(data.hasOwnProperty('token')){
      const {token} = data;
      store.set('token', {
        token_type:token.token_type,
        access_token:token.access_token,
        refresh_token:token.refresh_token,
        expires_in: Date.now() +  token.expires_in,
      })
    }
    store.set('user', data.user) 
  }
  componentWillMount() {
    this.props.logout();
  }
  redirect(location){
    const self = this; 
    const {data} = this.props.Authentication
    setTimeout(function(){
      self.setState((location == 'verification')?{ redirect : 'verification'} :{redirect: 'dashboard'});
    }, 5000)
  }
  resetNotice(){
    return this.setState({showToast:false, MessageBody:'',MessageTitle:''});
  }
  register(e){
    e.preventDefault();    
    this.resetNotice();
    const { formData } = this.state
    const { errors } = this.validator
    this.validator.validateAll(formData).then(success => {
        if (success) {
          this.setState({isLoading:true});
          this.props.register({data: formData}).then(
            (res)=> {
              const {Authentication} = this.props;
              const {hasError, data} = Authentication;
              (!!hasError) ? this.getError() : this.isSuccessFul(data, 'verification');
            }
          )
        } else {
          this.setState({ errors })
        }
    })
    
  }
  
  login(e){
    e.preventDefault();
    const { formData } = this.state
    this.setState({isLoading:true, showToast:false, MessageBody:'',MessageTitle:''});
    this.props.login({data: formData}).then(
      (res)=> {
        const {Authentication} = this.props;
        const {errorMessage, hasError, data} = Authentication;
        return (!!hasError) ? this.getError(errorMessage) : this.isSuccessFul(data, 'dashboard');
      }
    )
  }
  
  onChange(e){
    const name = e.target.name
    const value = e.target.value
    const { errors } = this.validator
    
    // reset errors for url field
    errors.remove(name)
    
    // update form data
    this.setState({ formData: { ...this.state.formData, [name]: value } , serverErrors:{}, isLoading:false,showToast:false,  MessageBody:'',
    MessageTitle:''})
    this.validator.validate(name, value)
      .then(() => {
        this.setState({ errors })
      })
  }

  toggleForm(e){
    this.setState({ serverErrors:{},isLoading:false,showToast:false,MessageBody:'',MessageTitle:'', formData :{name: '',email: '',password: '',password_confirmation: ''}, errors:this.validator.errors,})

    if(e.target.name === 'login' ){
			$('#container').removeClass("login-right-panel-active");
    }else{
			$('#container').addClass("login-right-panel-active");
    }
  }
  
  isLoading(){
    if(!this.state.isLoading){
      return;
    }
    return(  
      <LoadingOverlay />
    )
  }

  render() {
    if (this.state.redirect !== '') {
      if(this.state.redirect === 'verification'){
          return <Redirect to='/verification' replace/>
      }
      return <Redirect to='/dashboard' replace/>
    }

    const {errors, serverErrors, MessageBody,MessageTitle,showToast} = this.state;
    return (
      <React.Fragment>
      <div className="login-body">
        <Toast text={MessageBody} title={MessageTitle} showToast={showToast}/>
        {this.isLoading()}
        <div className="login-container" id="container">
          {/* Register Container */}
          <div className="login-form-container login-sign-up-container">
            <form className="login-form" action="" onSubmit={this.register}>
              <h1 style={{ color:'#ff5e00'}} className="login-h1">Create Account</h1>
              {/* <div className="login-social-container">
                <a href="#" className="login-social"><i class="fa fa-facebook-f" /></a>
                <a href="#" className="login-social"><i class="fa fa-google-plus" /></a>
                <a href="#" className="login-social"><i class="fa fa-linkedin" /></a>
              </div> */}
              <span className="login-span">Use your email for registration</span>
              <input 
                className="inputField" 
                value={this.state.name}  
                onChange={this.onChange} 
                name="name" 
                type="text" 
                placeholder="Name" 
              />
              {(serverErrors.name) ? 
                <span className="help-block text-danger input-error"> {serverErrors.name[0]} </span> : 
                '' 
              }
              { errors.has('name') &&
                <label id="name-error" className="error help-block text-danger input-error" htmlFor="name">
                  { errors.first('name') }
                </label>
              }
              <input 
                className="inputField" 
                value={this.state.email} 
                onChange={this.onChange} 
                name="email" 
                type="email" 
                placeholder="Email" 
              />
              {(serverErrors.email) ? 
                <span className="help-block text-danger input-error"> {serverErrors.email[0]} </span> : 
                ''
              }
              { errors.has('email') &&
                <label id="email-error" className="error help-block text-danger input-error" htmlFor="email">
                  { errors.first('email') }
                </label>
              }
              <input 
                className="inputField" 
                value={this.state.password} 
                onChange={this.onChange} 
                name="password" 
                type="password"  
                placeholder="Password" 
              />
              {(serverErrors.password) ? 
                <span className="help-block text-danger input-error"> {serverErrors.password[0]} </span> : 
                '' 
              }
              { errors.has('password') &&
                <label id="password-error" className="error help-block text-danger input-error" htmlFor="password">
                  { errors.first('password') }
                </label>
              }
              <input 
                className="inputField" 
                value={this.state.password_confirmation} 
                onChange={this.onChange} 
                name="password_confirmation" 
                type="password"  
                placeholder="Confirm Your Password" 
              />
              {(serverErrors.password_confirmation) ? 
                <span className="help-block text-danger input-error"> {serverErrors.password_confirmation[0]} </span> : 
                '' 
              }
              { errors.has('password_confirmation') &&
                <label id="password_confirmation-error" className="error help-block text-danger input-error" htmlFor="password_confirmation">
                  { errors.first('password_confirmation') }
                </label>
              }
              <button onClick={this.register} className="login-button">Sign Up</button>
            </form>
          </div>
          {/* Login Panel */}
          <div className="login-form-container login-sign-in-container">
            <form className="login-form" action="" onSubmit={this.login}>
              <h1 style={{ color:'#ff5e00'}}  className="login-h1">Sign in</h1>
              <div className="login-social-container">
                <a href="#" className="login-a login-social">
                    <i class="fa fa-facebook" />
                </a>
                <a href="#" className="login-a login-social">
                    <i class="fa fa-google-plus" />
                </a>
                <a href="#" className="login-a login-social">
                    <i class="fa fa-linkedin" />
                </a>
              </div>
              <span className="login-span">or use your account</span>
              <input 
                type="email" 
                name="email"
                placeholder="Email" 
                className="inputField" 
                value={this.state.email}
                onChange={this.onChange}
              />
              {(serverErrors.email) ? 
                <span className="help-block text-danger input-error"> {serverErrors.email[0]} </span> : 
                ''
              }
              { errors.has('email') &&
                <label id="email-error" className="error help-block text-danger input-error" htmlFor="email">
                  { errors.first('email') }
                </label>
              }
              <input 
                type="password" 
                name="password"
                className="inputField"
                onChange={this.onChange} 
                value={this.state.password}
                placeholder="Account Password" 
              />
              {(serverErrors.password) ? 
                <span className="help-block text-danger input-error"> {serverErrors.password[0]} </span> : 
                ''
              }
              { errors.has('password') &&
                <label id="password-error" className="error help-block text-danger input-error" htmlFor="password">
                  { errors.first('password') }
                </label>
              }
              <Link className="login-a" to="/password-recovery">Forgot your password?</Link>
              <button className="login-button" onClick={this.login}> Sign In</button>
            </form>
          </div>
          <div className="login-overlay-container">
            <div className="login-overlay">
              <div className="login-overlay-panel login-overlay-left">
                <h1 className="login-h1">Welcome Back!</h1>
                <p className="login-p">To keep connected with us please login with your personal info</p>
                <button 
                  onClick={this.toggleForm} 
                  name="login" 
                  className="login-button ghost" 
                  id="signIn"
                >Login</button>
              </div>
              <div className="login-overlay-panel login-overlay-right">
                <h1 className="login-h1">Hello, Friend!</h1>
                <p className="login-p">Enter your personal details and start journey with us</p>
                <button onClick={this.toggleForm} name="register" className="login-button ghost" id="signUp">Register</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer className="login-footer">
        <p className="">
          <Link to="/" className="footer-link">
            <i class="fa fa-home"></i>
            Home Page
          </Link>
          
          <Link to="/terms" className="footer-link">
            Privacy Policy
          </Link>.
        </p>
      </footer>
      </React.Fragment>
    )
  }
}
const mapStateToProps = (state)=>{
  return {
    Authentication : state.AuthenticationReducer
  }
}

export default connect(mapStateToProps,{ register, login, logout })(LoginPage)