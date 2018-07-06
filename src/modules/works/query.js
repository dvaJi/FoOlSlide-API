// Imports
import { GraphQLString, GraphQLInt, GraphQLList } from 'graphql';

// App Imports
import { WorkType, WorksStatusType } from './types';
import {
  getAll,
  getByStub,
  getById,
  getRandom,
  getStatusTypes
} from './resolvers';

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

// Random Work
export const workRandom = {
  type: WorkType,
  args: {
    language: { type: GraphQLString }
  },
  resolve: getRandom
};

// Work Types
export const workStatusTypes = {
  type: new GraphQLList(WorksStatusType),
  resolve: getStatusTypes
};
