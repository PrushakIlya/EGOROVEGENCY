import {getTopGuilds} from "./api/api-top.js"
import {GETTOPGUILDS} from "./api/api-type.js"

const block_guilds = document.getElementById('top_guilds-block');
getTopGuilds(block_guilds,GETTOPGUILDS);

