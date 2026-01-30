export interface IPublication {
    id?: number; // Usually Laravel models have an id
    title: string;
    authors: { name: string }[]; // or string[] if it's an array
    date: Date;
    type: string;
    abstract?: string | null;
    publisher?: string | null;
    venue?: string | null;
    volume?: string | null;
    number?: string | null;
    pages?: string | null;
    doi?: string | null;
    isbn?: string | null;
    issn?: string | null;
    gs_cluster_id?: string | null;
    article_link?: string | null;
    pdf_link?: string | null;
    citation_count?: number | null;
    keywords?: string[] | null;
    created_at?: string;
    updated_at?: string;
}
