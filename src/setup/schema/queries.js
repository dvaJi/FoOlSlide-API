// Imports
import { GraphQLObjectType } from "graphql";

// App Imports
import * as user from "../../modules/user/query";
import * as product from "../../modules/product/query";
import * as crate from "../../modules/crate/query";
import * as subscription from "../../modules/subscription/query";
import * as works from "../../modules/works/query";
import * as worksDescription from "../../modules/works-description/query";
import * as WorksGenre from "../../modules/works-genre/query";
import * as chapter from "../../modules/chapter/query";
import * as page from "../../modules/page/query";
import * as people from "../../modules/people/query";

// Query
const query = new GraphQLObjectType({
  name: "query",
  description: "API Queries [Read]",
  fields: () => ({
    ...user,
    ...product,
    ...crate,
    ...subscription,
    ...works,
    ...chapter,
    ...page,
    ...worksDescription,
    ...WorksGenre,
    ...people
  })
});

export default query;
