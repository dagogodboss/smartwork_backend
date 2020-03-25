import React from "react";
import thunk from "redux-thunk";
import promise from "redux-promise-middleware";
import { applyMiddleware, createStore, compose } from "redux";
import { createLogger } from 'redux-logger'
import reducer from "../site-reducers";

const middleware = applyMiddleware(...[thunk, promise(), createLogger()]);

export default createStore(reducer, compose(middleware, window.devToolsExtension ? window.devToolsExtension() : f => f)
);