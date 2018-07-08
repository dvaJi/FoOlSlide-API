// Imports
import { GraphQLInt, GraphQLString, GraphQLList } from 'graphql';

// App Imports
import { WorksDescriptionType } from './types';
import { getByWork } from './resolvers';

// WorksDescription By Work
export const worksDescriptionsByWork = {
  type: new GraphQLList(WorksDescriptionType),
  args: {
    workId: { type: GraphQLInt },
    language: { type: GraphQLString }
  },
  resolve: getByWork
};
