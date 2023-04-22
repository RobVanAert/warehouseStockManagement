import {Article} from "./article";

export interface PaginatedArticles {
  data: Article[];
  links: {}
  meta: {}
}
