// Imports
import { GraphQLObjectType, GraphQLString, GraphQLInt } from 'graphql';

// App Imports
import { WorkType } from '../works/types';

// WorksDescription type
const WorksDescriptionType = new GraphQLObjectType({
  name: 'worksDescription',
  description: 'WorksDescription Type',

  fields: () => ({
    id: { type: GraphQLInt },
    work: { type: WorkType },
    language: { type: GraphQLString },
    description: { type: GraphQLString },
    createdAt: { type: GraphQLString },
    updatedAt: { type: GraphQLString }
  })
});

export { WorksDescriptionType };
