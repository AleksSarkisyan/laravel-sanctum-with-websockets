
export type CreateCategoryFormModel = {
  name: string;
  description: string;
}

export interface CreateCategoryComponentData {
  createCategoryFormData: CreateCategoryFormModel;
}

export type Categories = {
  data?: {
    categories: Category[]
  }
}

export type Category = {
  id: number;
  name: string;
  description: string;
}

export type AvailableCategories = {
  label: string;
  value: number;
}
