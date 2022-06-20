import { getTopUsers } from './api/api-top.js';
import { GETTOPUSERS } from './api/api-type.js';

const block_users = document.getElementById('top_users-block');
getTopUsers(block_users, GETTOPUSERS);
