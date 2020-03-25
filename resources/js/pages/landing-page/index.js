import React, { Component } from 'react';
import Nav from './components/Nav/Nav';
import Welcome from './components/Welcome/Welcome';
import Mainsection from './components/Mainpage/Mainsection';
import Features from './components/Features/Features';
import Contact from './components/Contact/Contact';
import Team from './components/Team/Team';
import Footer from './components/Footer/Footer';

class LandingPage extends Component {

  render() {
    return (
      <React.Fragment>
      <Nav />
      <Welcome/>
      <Mainsection />
      <Features />
      


        {/* ***** CTA Area Start ***** */}
        <section className="our-monthly-membership section_padding_50 clearfix">
          <div className="container">
            <div className="row align-items-center">
              <div className="col-md-8">
                <div className="membership-description">
                  <h2>Join PayNow Monthly Membership</h2>
                 
                </div>
              </div>
              <div className="col-md-4">
                <div className="get-started-button wow bounceInDown" data-wow-delay="0.5s">
                  <a href="#">Get Started</a>
                </div>
              </div>
            </div>
          </div>
        </section>
        {/* ***** CTA Area End ***** */}
        <Team />
        {/* ***** Contact Us Area Start ***** */}
        <Contact />
        {/* ***** Contact Us Area End ***** */}
        {/* ***** Footer Area Start ***** */}
      <Footer />
      </React.Fragment>
    );

  }
}

export default LandingPage;
