// Imports
import { GraphQLInt, GraphQLString, GraphQLList } from "graphql";

// App Imports
import { ChapterType } from "./types";
import { getAll, getByWork } from "./resolvers";

// Chapters All
export const chapters = {
  type: new GraphQLList(ChapterType),
  args: {
    language: { type: GraphQLString },
    orderBy: { type: GraphQLString },
    first: { type: GraphQLInt },
    offset: { type: GraphQLInt }
  },
  resolve: getAll
};

// Chapter By Work
export const chaptersByWork = {
  type: new GraphQLList(ChapterType),
  args: {
    workId: { type: GraphQLInt },
    language: { type: GraphQLString }
  },
  resolve: getByWork
};
