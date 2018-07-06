// Imports
import {
  GraphQLList,
  GraphQLObjectType,
  GraphQLString,
  GraphQLInt,
  GraphQLBoolean
} from 'graphql';

// App Imports
import { WorkType } from '../works/types';
import { PageType } from '../page/types';

// Chapter type
const ChapterType = new GraphQLObjectType({
  name: 'chapter',
  description: 'Chapter Type',

  fields: () => ({
    id: { type: GraphQLInt },
    work: { type: WorkType },
    pages: { type: new GraphQLList(PageType) },
    chapter: { type: GraphQLInt },
    subchapter: { type: GraphQLInt },
    volume: { type: GraphQLInt },
    language: { type: GraphQLString },
    name: { type: GraphQLString },
    stub: { type: GraphQLString },
    uniqid: { type: GraphQLString },
    hidden: { type: GraphQLBoolean },
    description: { type: GraphQLString },
    thumbnail: { type: GraphQLString },
    createdAt: { type: GraphQLString },
    updatedAt: { type: GraphQLString }
  })
});

export { ChapterType };
