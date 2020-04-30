USE [SRO_VT_ACCOUNT]
GO

/****** Object:  Table [dbo].[websro_download]    Script Date: 05/17/2013 19:52:33 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[websro_download](
	[FileName] [varchar](24) NULL,
	[Description] [nchar](32) NULL,
	[Link] [varchar](128) NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


