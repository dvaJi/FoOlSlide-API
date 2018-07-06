// Imports
import {
  GraphQLList,
  GraphQLObjectType,
  GraphQLString,
  GraphQLInt,
  GraphQLBoolean
} from 'graphql';

// App Imports
import { ChapterType } from '../chapter/types';
import { WorksDescriptionType } from '../works-description/types';
import { WorksCoverType } from '../works-cover/types';
import { WorksGenreType } from '../works-genre/types';
import { PeopleWorksType } from '../people-works/types';

// Works type
const WorkType = new GraphQLObjectType({
  name: 'works',
  description: 'Works Type',

  fields: () => ({
    id: { type: GraphQLInt },
    chapters: { type: new GraphQLList(ChapterType) },
    works_descriptions: { type: new GraphQLList(WorksDescriptionType) },
    works_covers: { type: new GraphQLList(WorksCoverType) },
    works_genres: { type: new GraphQLList(WorksGenreType) },
    people_works: { type: new GraphQLList(PeopleWorksType) },
    name: { type: GraphQLString },
    stub: { type: GraphQLString },
    uniqid: { type: GraphQLString },
    type: { type: GraphQLString },
    hidden: { type: GraphQLBoolean },
    demographicId: { type: GraphQLInt },
    status: { type: GraphQLInt },
    statusReason: { type: GraphQLString },
    adult: { type: GraphQLBoolean },
    visits: { type: GraphQLInt },
    createdAt: { type: GraphQLString },
    updatedAt: { type: GraphQLString }
  })
});

// Works status type
const WorksStatusType = new GraphQLObjectType({
  name: 'worksStatusType',
  description: 'Works Status Type',

  fields: () => ({
    id: { type: GraphQLInt },
    name: { type: GraphQLString }
  })
});

export { WorkType, WorksStatusType };
