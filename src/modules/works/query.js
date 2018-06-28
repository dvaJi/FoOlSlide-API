// Imports
import { GraphQLString, GraphQLInt, GraphQLList } from "graphql";

// App Imports
import { WorkType, WorksStatusType } from "./types";
import {
  getAll,
  getByStub,
  getById,
  getRelated,
  getStatusTypes
} from "./resolvers";

// Works All
export const works = {
  type: new GraphQLList(WorkType),
  args: {
    orderBy: { type: GraphQLString },
    first: { type: GraphQLInt },
    offset: { type: GraphQLInt },
    language: { type: GraphQLString }
  },
  resolve: getAll
};

// Work By stub
export const work = {
  type: WorkType,
  args: {
    stub: { type: GraphQLString },
    language: { type: GraphQLString }
  },
  resolve: getByStub
};

// Work By ID
export const workById = {
  type: WorkType,
  args: {
    workId: { type: GraphQLInt },
    language: { type: GraphQLString }
  },
  resolve: getById
};

// Works Related
export const worksRelated = {
  type: new GraphQLList(WorkType),
  args: {
    workId: { type: GraphQLInt },
    language: { type: GraphQLString }
  },
  resolve: getRelated
};

// Work Types
export const workStatusTypes = {
  type: new GraphQLList(WorksStatusType),
  resolve: getStatusTypes
};
