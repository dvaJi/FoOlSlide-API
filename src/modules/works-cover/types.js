// Imports
import {
  GraphQLObjectType,
  GraphQLString,
  GraphQLInt,
  GraphQLBoolean
} from 'graphql';

// App Imports
import { WorkType } from '../works/types';

// WorksCover type
const WorksCoverType = new GraphQLObjectType({
  name: 'worksCover',
  description: 'WorksCover Type',

  fields: () => ({
    id: { type: GraphQLInt },
    work: { type: WorkType },
    filename: { type: GraphQLString },
    coverTypeId: { type: GraphQLInt },
    hidden: { type: GraphQLBoolean },
    height: { type: GraphQLInt },
    width: { type: GraphQLInt },
    size: { type: GraphQLInt },
    mime: { type: GraphQLString },
    createdAt: { type: GraphQLString },
    updatedAt: { type: GraphQLString }
  })
});

// Genres type
const CoversType = new GraphQLObjectType({
  name: 'coversType',
  description: 'Covers Type',

  fields: () => ({
    id: { type: GraphQLInt },
    name: { type: GraphQLString },
    width: { type: GraphQLInt },
    height: { type: GraphQLInt }
  })
});

export { WorksCoverType, CoversType };
