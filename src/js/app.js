import $ from "jquery";
import _ from "lodash";
import "bootstrap";
import "bootstrap/scss/bootstrap.scss";
import "datatables.net";
import dt from "datatables.net-bs4";
import 'datatables.net-bs4/css/dataTables.bootstrap4.css';

dt(window, $);

require("./datatable");
require("./sidebar");
require('./modal');