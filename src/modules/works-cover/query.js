// Imports
import { GraphQLInt, GraphQLList } from 'graphql';

// App Imports
import { CoversType, WorksCoverType } from './types';
import { getByWork, getTypes } from './resolvers';

// Page By Work
export const worksCoversByWork = {
  type: new GraphQLList(WorksCoverType),
  args: {
    workId: { type: GraphQLInt }
  },
  resolve: getByWork
};

// Covers Types
export const coversTypes = {
  type: new GraphQLList(CoversType),
  resolve: getTypes
};
