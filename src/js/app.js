import { $, jQuery } from "jquery";
window.$ = $;
window.jQuery = jQuery;

import _ from "lodash";
window._ = _;

import firebase from "firebase";
window.firebase = firebase;

import GeoFire from "geofire";
window.GeoFire = GeoFire;


import "bootstrap";
import "bootstrap/scss/bootstrap.scss";
import "datatables.net";
import dt from "datatables.net-bs4";
import 'datatables.net-bs4/css/dataTables.bootstrap4.css';

require("./datatable");
require("./sidebar");
require('./modal');
require('./form-validation');
require('./map');

