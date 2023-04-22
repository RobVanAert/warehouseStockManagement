import {Article} from "./article";
import {Paginator} from "./paginator";

export interface PaginatedArticles {
  data: Article[];
  links: {}
  meta: Paginator
}
