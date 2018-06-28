// Imports
import { GraphQLObjectType } from "graphql";

// App Imports
import * as user from "../../modules/user/mutations";
import * as product from "../../modules/product/mutations";
import * as crate from "../../modules/crate/mutations";
import * as subscription from "../../modules/subscription/mutations";
import * as chapter from "../../modules/chapter/mutations";
import * as page from "../../modules/page/mutations";
import * as works from "../../modules/works/mutations";
import * as worksDescription from "../../modules/works-description/mutations";
import * as worksGenre from "../../modules/works-genre/mutations";
import * as people from "../../modules/people/mutations";

// Mutation
const mutation = new GraphQLObjectType({
  name: "mutations",
  description: "API Mutations [Create, Update, Delete]",

  fields: {
    ...user,
    ...product,
    ...crate,
    ...subscription,
    ...works,
    ...chapter,
    ...page,
    ...worksDescription,
    ...worksGenre,
    ...people
  }
});

export default mutation;
