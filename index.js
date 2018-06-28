"use strict";

var _express = require("express");

var _express2 = _interopRequireDefault(_express);

var _loadModules = require("./build/setup/load-modules");

var _loadModules2 = _interopRequireDefault(_loadModules);

var _graphql = require("./build/setup/graphql");

var _graphql2 = _interopRequireDefault(_graphql);

var _upload = require("./build/setup/upload");

var _upload2 = _interopRequireDefault(_upload);

var _startServer = require("./build/setup/start-server");

var _startServer2 = _interopRequireDefault(_startServer);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

// Create express server


// App Imports
var server = (0, _express2.default)();

// Setup load modules
// Imports
(0, _loadModules2.default)(server);

// Setup uploads
(0, _upload2.default)(server);

// Setup GraphQL
(0, _graphql2.default)(server);

// Start server
(0, _startServer2.default)(server);
//# sourceMappingURL=index.js.map