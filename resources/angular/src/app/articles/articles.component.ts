import { Component, Input } from '@angular/core';
import {Article} from "../article";
import {ArticleService} from "../article.service";
import {PaginatedArticles} from "../paginated-articles";
import {Paginator} from "../paginator";

@Component({
  selector: 'app-articles',
  templateUrl: './articles.component.html',
  styleUrls: ['./articles.component.scss']
})
export class ArticlesComponent {
  articles: Article[] = [];
  paginator: Paginator|undefined;
  @Input() authorized: boolean = false;
  constructor(private articleService: ArticleService) { }

  ngOnInit() {
    this.getArticles();
  }

  pageChange(page: number) {
    this.articleService.getArticles(page).subscribe((paginatedArticles: PaginatedArticles) => {
      this.articles = paginatedArticles.data;
    });
  }

  deleteArticle(id: number) {
    this.articleService.deleteArticle(id).subscribe(() => {
      this.getArticles();
    });
  }

  getArticles() {
    this.articleService.getArticles().subscribe((paginatedArticles: PaginatedArticles) => {
      this.articles = paginatedArticles.data;
      this.paginator = paginatedArticles.meta;
    });
  }
}
