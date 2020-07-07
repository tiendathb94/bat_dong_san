import LocationInfrastructure from "./layout/LocationInfrastructure"
import CustomContent from "./layout/CustomContent"
import ProjectProgress from "./layout/ProjectProgress"
import { find } from 'lodash'

const Helper = {
    getTabTypes: () => {
        return [
            {
                name: 'Vị trí - Hạ tầng',
                layout: 'location_infrastructure',
                component: LocationInfrastructure,
                contentFields: ['location', 'infrastructure'],
            },
            { 
                name: 'Tiến độ dự án', 
                layout: 'project_progress',
                component: ProjectProgress,
                contentFields: ['date_updload_file', 'progressImageFiles', 'removeFileIds'],
            },
            {
                name: 'Nội dung tùy chỉnh',
                layout: 'custom',
                component: CustomContent,
                contentFields: ['content'],
            },
        ]
    },

    getTabTypeByLayout: (layoutName) => {
        return find(Helper.getTabTypes(), { layout: layoutName })
    }
}

export default Helper
