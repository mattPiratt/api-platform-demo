import type { Item } from './item'

export interface Message extends Item {
  sender?: string
  recipient?: string
  subject?: string
  content?: string
  status?: number
}
